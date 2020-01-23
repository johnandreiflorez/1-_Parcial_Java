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
public class Stack {

    protected int size;
    protected int maxSize;
    protected SimpleNode head;

    /**
     * A custom Stack class
     *
     * @param maxSize the max number of elements allowed in the stack
     */
    public Stack(int maxSize) {
        size = 0;
        head = null;
        this.maxSize = maxSize;
    }

    // #########################################################################
    // PUBLIC METHODS  #########################################################
    // #########################################################################
    
    /**
     * Adds an item onto the stack.
     * @param data any data type can be used
     */
    public void push(Object data) {
        // se agrega solo si aún no se llena 
        if (!isFull()) {
            
            // la estructura crece en un elemento
            size++;
            
            // el nuevo elemento se agrega al stack
            addToStack(data);
        }
    }

    /**
     * Returns the last item pushed onto the stack. Does not modifies the Stack
     * @return Object
     */
    public Object top() {
        if(!isEmpty()){
            //si no está vacia se retorna la cabeza sin eliminarla
            return getHead().getData();
        } else {
            // el stack está vacio no hay elemento a retornar
            return null;
        }
    }

    /**
     * Removes the most-recently-pushed item from the stack.
     *
     * @return Object
     */
    public Object pop() {
        if( !isEmpty() )
        {
            size--;
            return getAndRemoveHead();
        } else {
            return null;
        }
    }

    /**
     * True if no more items can be popped and there is no top item.
     *
     * @return boolean
     */
    public boolean isEmpty() {
        if(size > 0)
            return false;
        else
            return true;
    }

    /**
     * True if no more items can be pushed
     * @return boolean
     */
    public boolean isFull() {
        if(size >= maxSize)
            return true;
        else 
            return false;
    }

    /**
     * The number of elements in the stack
     * @return int
     */
    public int getSize() {
        return size;
    }
    
    public SimpleNode getHead(){
        return head;
    }

    public void setHead(SimpleNode head) {
        this.head = head;
    }    
    
    // #########################################################################
    // PRIVATE METHODS  ########################################################
    // #########################################################################
    /**
     * inserts data as the head in the stack
     * @param data adds data to the stack, any data type can be used
     */
    private void addToStack(Object data) {
        SimpleNode node = new SimpleNode(data);
        
        //el nodo nuevo tiene como siguiente a la antigua cabeza
        node.setNext(getHead());
        //la cabeza ahora corresponde al nuevo elemento
        setHead(node);
    }
    
    /**
     * inserts data as the head in the stack
     *
     * @param data
     */
    private Object getAndRemoveHead() {
        Object data = null;
        if (getHead() != null && getHead().getNext() == null) {
            //si la cabeza no tiene siguiente, se obtiene el dato
            //y la cabeza se coloca null porque se retira el ultimo elemento
            data = getHead().getData();
            setHead(null);
        } else {
            //si la cabeza tiene otros elementos, entonces se debe redefinir la 
            //cabeza como el elemento siguiente a la vieja cabeza
                data = getHead().getData();
                SimpleNode oldHead = getHead();
                setHead(oldHead.getNext());
            }
        return data;
    }  
}
