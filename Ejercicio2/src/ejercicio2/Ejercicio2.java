/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package ejercicio2;
import modelo.Bulto;
import control.LlenarBoing;
import java.util.Random;
import vista.Imprimir;
/**
 *
 * @author Andrei Florez V
 */
public class Ejercicio2 {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        // TODO code application logic here
        Imprimir objImprimir = new Imprimir();
        LlenarBoing objLlenar = new LlenarBoing();
        int i=0;
        Random objRandom = new Random();
        do{
            i=objLlenar.cargar(i,new Bulto(objRandom.nextInt(500)));
        }while (i<15);
        System.out.println(objLlenar.toString());
        objImprimir.tabla(objLlenar.getEquipajes());
    }
    
}
