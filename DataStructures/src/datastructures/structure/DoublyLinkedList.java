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
public class DoublyLinkedList {

    DoubleLinkingNode first;
    DoubleLinkingNode last;
    DoubleLinkingNode selected;
    int size;

    public DoublyLinkedList() {
        first = last = selected = null;
        size = 0;
    }

    // #########################################################################
    // PUBLIC METHODS  #########################################################
    // #########################################################################
    /*
    public DoubleLinkingNode getFirst() {
        return first;
    }

    public void setFirst(DoubleLinkingNode first) {
        this.first = first;
    }

    public DoubleLinkingNode getLast() {
        return last;
    }

    public void setLast(DoubleLinkingNode last) {
        this.last = last;
    }

    public int getSize() {
        return size;
    }*/
    
    /**
     * returns the selected element inside the list
     * @return node
     */
    public DoubleLinkingNode getSelected() {
        return selected;
    }

    /**
     * sets the selected element at the first element of the list
     */
    public void goFirst() {
        selected = first;
    }
    
    /**
     * sets the selected element at the last element of the list
     */
    public void goLast() {
        selected = last;
    }
    
    /**
     * Moves the selected element to the next in the list 
     */
    public void next(){
        if(selected!=null){
            selected = selected.getNext();
        }
    }
    
    /**
     * Moves the selected element to the previous in the list 
     */
    public void previous(){
        if(selected!=null){
            selected = selected.getPrevious();
        }
    }
    
    /**
     * inserts data at the end of the list
     * @param data
     */
    public void pushEnd(Object data) {
        //encapsulamos el dato en un nodo doblemente ligado
        DoubleLinkingNode node = new DoubleLinkingNode(data);

        if (first != null) {
            //se enlaza la cola de la lista con el nuevo nodo
            last.setNext(node);
            node.setPrevious(last);

            //Se actualizan las posiciones del ultimo y el seleccionado
            last = node;
            selected = node;
        } else {
            //si la lista está vacía, se agrega el primer elemento
            first = last = selected = node;
        }
        //se incrementa el tamaño
        size++;
    }

    /**
     * inserts an element after the node passed as argument
     * @param data
     */
    public void pushAfterSelected(Object data){
        //si la lista está vacía llenamos al final
        if(first == null){
            pushEnd(data);
            return;//se termina el sub-programa en este caso
        }

        DoubleLinkingNode newNode = new DoubleLinkingNode(data);
        
        //hay 2 casos, el siguiente de selected es null o es un nodo
        if(selected.getNext() != null){
            //si hay siguiente es el caso complejo
            //debemos insertar entre 2 nodos
            //conectamos el nuevo nodo
            newNode.setNext(selected.getNext());
            newNode.setPrevious(selected);

            //actualizamos las conecciones alrededor del nuevo nodo
            selected.setNext(newNode);
            newNode.getNext().setPrevious(newNode); 
        } else {
            //si selected no tiene siguiente se actualiza unicamente 
            //el anterior del nuevo nodo
            newNode.setNext(null);//opcional
            newNode.setPrevious(selected);
            
            //actualizamos la conexión izquierda alrededor del nuevo nodo
            selected.setNext(newNode);
            
            //el nuevo nodo es el nuevo último
            last = newNode;
        }
        
        //Actualizamos el seleccionado
        selected=newNode;
        //se incrementa el tamaño
        size++;
    }
    
    /**
     * inserts an element before the node passed as argument
     * @param data 
     */
    public void pushBeforeSelected(Object data){
        //si la lista está vacía llenamos al final
        if(first == null){
            pushEnd(data);
            return;//se termina el sub-programa en este caso
        }
        
        DoubleLinkingNode newNode = new DoubleLinkingNode(data);
        
        //hay 2 casos: el anterior de selected es null o es un nodo
        if(selected.getPrevious() != null){
            //si hay anterior es el caso complejo
            //debemos insertar entre 2 nodos
            //conectamos el nuevo nodo
            newNode.setPrevious(selected.getPrevious());
            newNode.setNext(selected);
            
            //actualizamos las conecciones alrededor del nuevo nodo
            selected.getPrevious().setNext(newNode);
            selected.setPrevious(newNode);
        } else {
            //si selected no tiene anterior se actualiza unicamente 
            //el siguiente del nuevo nodo
            newNode.setPrevious(null);//opcional
            newNode.setNext(selected);
            
            //actualizamos la conexión derecha alrededor del nuevo nodo
            selected.setPrevious(newNode);
            
            //el nuevo nodo es el nuevo primer elemento
            first = newNode;
        }
        
        //Actualizamos el seleccionado
        selected=newNode;
        //se incrementa el tamaño
        size++;
    }
}
