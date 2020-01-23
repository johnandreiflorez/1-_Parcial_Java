/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package vista;
import modelo.Bulto;
/**
 *
 * @author Andrei Florez V
 */
public class Imprimir {
    public void tabla (Bulto [] paquetes){
        System.out.println ("PESO     |     PRECIO");
        for(int i=0; i<15;i++){
            System.out.println(paquetes[i].getPeso()+"      |    "+ paquetes[i].getCosto());
        }
    }
}
