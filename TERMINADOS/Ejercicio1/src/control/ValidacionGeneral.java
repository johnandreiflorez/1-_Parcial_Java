/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package control;

import javax.swing.JOptionPane;

/**
 *
 * @author jaflorez
 */
public class ValidacionGeneral {

    public ValidacionGeneral() {
    }
     
    public int esNumeroEntero (String mensaje){
        int num=0;
        boolean sw = true;
        do{
            try{
                num = Integer.parseInt(JOptionPane.showInputDialog(mensaje));
                sw =  true;
            }catch(Exception e){
                JOptionPane.showMessageDialog(null, " ERROR. Ingrese solo numeros.");
                sw= false;
            }
        }while(!sw);
        return num;
    }
    public String cadenaMayuscula (String cadena){
        cadena= cadena.toUpperCase();
     return cadena;   
    }
    public String cadenaMinuscula(String cadena){
        cadena = cadena.toLowerCase();
        return cadena;
    }
    public boolean esLetra (String cadena){
        try{
            if(cadena.matches("^[A-Za-z ]*$"))
                return true;
            else
                return false;
        }catch(Exception e){
            JOptionPane.showMessageDialog(null, " ERROR. Ingrese solo letras.");
            return false;
        }
    }
}
