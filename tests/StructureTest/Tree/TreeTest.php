<?php

use Structure\Tree\GeneralTree;

class TreeTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        //$this->test = 'test';
    }

    public function tearDown()
    {
        //unset($this->test);
    }

    public function testGeneralTree()
    {
        $generalTree = new GeneralTree(box('A'));
        $generalTree->attachSubtree(new GeneralTree(box('B')));
        $generalTree->attachSubtree(new GeneralTree(box('C')));
        $generalTree->attachSubtree(new GeneralTree(box('D')));
        $generalTree->attachSubtree(new GeneralTree(box('E')));

        $this->treeBase($generalTree);
    }

    private function treeBase($tree)
    {
        printf("Breadth-First traversal\n");
        $tree->breadthFirstTraversal(
            new PrintingVisitor(STDOUT));

        printf("Preorder traversal\n");
        $tree->depthFirstTraversal(new PreOrder(
            new PrintingVisitor(STDOUT)));

        printf("Inorder traversal\n");
        $tree->depthFirstTraversal(new InOrder(
            new PrintingVisitor(STDOUT)));

        printf("Postorder traversal\n");
        $tree->depthFirstTraversal(new PostOrder(
            new PrintingVisitor(STDOUT)));

        printf("Using foreach\n");
        foreach ($tree as $obj)
        {
            printf("%s\n", str($obj));
        }

        printf("Using reduce\n");
        $tree->reduce(create_function(
            '$sum,$obj', 'printf("%s\n", str($obj));'), '');

        printf("Using accept\n");
        $tree->accept(new ReducingVisitor(create_function(
            '$sum,$obj', 'printf("%s\n", str($obj));'), ''));
    }
}


