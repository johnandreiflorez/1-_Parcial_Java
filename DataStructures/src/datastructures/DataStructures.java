/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package datastructures;
import datastructures.structure.*;
import java.util.Random;

/**
 *
 * @author Danny Alvarez
 */
public class DataStructures {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        // TODO code application logic here
        
        System.out.println("STACK  ##########################################");
        Stack myStack = new Stack(50);
        for (int i = 0; i < 20; i++) {
            myStack.push( i*10 );
        }
        
        for (int i = 0; i < 20; i++) {
            System.out.println(myStack.pop());
        }
        
        System.out.println("");
        System.out.println("QUEUE  ##########################################");
        Queue myQueue = new Queue(10);
        for (int i = 0; i < 20; i++) {
            myQueue.push( i*10 );
        }
        
        for (int i = 0; i < 20; i++) {
            System.out.println(myQueue.pop());
        }
        
        System.out.println("");
        System.out.println("SINGLY LINKED LIST  #############################");
        SinglyLinkedList mySimpleList = new SinglyLinkedList();
        for (int i = 0; i < 3; i++) 
        {
            mySimpleList.addToTheBegining(i);
            mySimpleList.addToTheEnd(i*10);
        }
        
        while ( ! mySimpleList.isEmpty() ) 
        {            
            Object dataToPrint = mySimpleList.popAndRemoveHead();
            System.out.println("-> "+dataToPrint);
        }
        
        System.out.println("");
        System.out.println("DOUBLY LINKED LIST  #############################");
        DoublyLinkedList myList = new DoublyLinkedList();
        for (int i = 0; i < 20; i++) {
            myList.pushEnd(i*10);
        }
        
        //INSERTAMOS ELEMENTOS DESPUES DE LA TERCERA POSICIÓN
        myList.goFirst();
        myList.next();
        myList.next();
        myList.pushAfterSelected(Math.PI);
        //INSERTAMOS UN ELEMENTO DESPUÉS DE LA ULTIMA POSICIÓN
        myList.goLast();
        myList.pushAfterSelected(Math.E);
        
        //INSERTAR ANTES DEL PRIMER ELEMENTO
        myList.goFirst();
        myList.pushBeforeSelected(Math.PI*100);
                
        //INSERTAR ANTES DE UN ELEMENTO INTERMEDIO
        myList.goLast();
        myList.previous();
        myList.previous();
        myList.previous();
        myList.pushBeforeSelected(Math.E*100);
        
        myList.goFirst();
        while (myList.getSelected() != null) {
            
            System.out.println(myList.getSelected().getData());
            myList.next();
        }
    }
}
