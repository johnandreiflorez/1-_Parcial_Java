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
public class Queue {
    protected int size;
    protected int maxSize;
    protected SimpleNode head;
    protected SimpleNode tail;
    
     /**
     * A custom Queue class. It has no limit to queue elements. 
     * @param maxSize max number of elements allowed in the queue
     */
    public Queue(int maxSize) {
        size = 0;
        this.maxSize = maxSize;
        head = null;
        tail = null;
        
    }

    public SimpleNode getHead() {
        return head;
    }

    public void setHead(SimpleNode head) {
        this.head = head;
    }

    public int getSize() {
        return size;
    }
    
    // #########################################################################
    // PUBLIC METHODS  #########################################################
    // #########################################################################
    
    /**
     * Adds an item onto the Queue.
     * @param data any data type can be used
     */
    public void push(Object data) {
        //se crea un nodo para el elemento
        SimpleNode node = new SimpleNode(data);
        
        //si la lista este llena no se puede agregar elementos
        if (isFull()) 
            return;
        
        // se verifica si está vacía
        if (isEmpty()) {         
            // el nuevo elemento es la cabeza y la cola    
            head = node;
            tail = node;
            
        } else {
            // el nuevo elemento se encola en la última posición (al otro extremo)
            tail.setNext(node);
            tail = node;
        }
        //se incrementa el tamaño 
        size++;
        
    }
    
    /**
     * Removes the last-recently-pushed item from the Queue.
     * @return Object
     */
    public Object pop() {
        Object result = null;
        if( !isEmpty() )
        {
            //si la cola no está vacía se remueve el primer elemento
            size--;
            result = head.getData();
            
            if(tail == head){
                //si la cola tiene un elemento, la cola y la cabeza son vacias
                tail = head = null;
            } else {
                //si la cola tiene más de un elemento, la cabeza se convierte
                //en el siguiente
                SimpleNode oldHead = head.getNext();//el elemento sobra
                head = head.getNext();
                
                //la Cabeza Antigua se puede hacer null
                oldHead = null;//no llama al garbage collector
            }
        } else {
            result = null;
        }
        return result;
    }
    
    /**
     * True if no more items can be queued
     * @return boolean
     */
    public boolean isFull() {
        if(size >= maxSize)
            return true;
        else 
            return false;
        
        // return size >= maxSize; // significa lo mismo
    }
    
    /**
     * True if no more items can be popped and there is no top item.
     * @return boolean
     */
    public boolean isEmpty() {
        if(size > 0) 
            return false;
        else
            return true;
        
        //o simplemente  #######################################################
        //return size <= 0;
    }
    /**
     * returns the data contained in the front node. It doesn't removes the 
     * element from the Queue 
     * @return Object from Queue
     */
    public Object  peek()
    {
       Object dato=null; 
       if( !isEmpty() )
       {
           dato = getHead().getData();
       }
       return dato;
    }//Fin método peek
    
    // #########################################################################
    // PRIVATE METHODS  ########################################################
    // #########################################################################
}