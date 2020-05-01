/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Modelo;

/**
 *
 * @author Andrei Florez V
 */
public class Horse {
     private int id;
    private String name;

    public Horse(int id) {
        this.id = id;
        nameHorse();
    }
    
    
    public Horse(int id, String name) {
        this.id = id;
        this.name = name;
    }

    public int getId() {
        return id;
    }

    public String getName() {
        return name;
    }
    
    
     private void nameHorse(){
         switch(id){
             case 1:
                 name = "Tales 1";
             case 2:
                 name = "Tales 2";
             case 3:
                 name = "Tales 3";
             case 4: 
                 name = "Tales 4";
             default:
                 break;
         }
     }
}
