/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package datastructures.structure;

/**
 *
 * @author Danny Alvarez
 */
public class DoubleLinkingNode {
    protected Object data;
    protected DoubleLinkingNode previous;
    protected DoubleLinkingNode next;

    /**
     * Double binding node data structure
     *
     * @param data element to be contained in the node
     */
    public DoubleLinkingNode(Object data) {
        this.data = data;
        next = null;
    }
    
    // #########################################################################
    // PUBLIC METHODS  #########################################################
    // #########################################################################
    public Object getData() {
        return data;
    }

    public void setData(Object data) {
        this.data = data;
    }

    public DoubleLinkingNode getPrevious() {
        return previous;
    }

    public void setPrevious(DoubleLinkingNode previous) {
        this.previous = previous;
    }

    public DoubleLinkingNode getNext() {
        return next;
    }

    public void setNext(DoubleLinkingNode next) {
        this.next = next;
    }
}
