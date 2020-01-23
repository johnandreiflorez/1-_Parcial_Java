/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package structure;

/**
 *
 * @author Danny Alvarez
 */
public class SimpleNode {

    protected Object data;
    protected SimpleNode next;

    /**
     * SimpleNode data structure
     *
     * @param data element to be contained in the node
     */
    public SimpleNode(Object data) {
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

    public SimpleNode getNext() {
        return next;
    }

    public void setNext(SimpleNode next) {
        this.next = next;
    }

    @Override
    public String toString() {
        return data.toString();
    }

    
}
