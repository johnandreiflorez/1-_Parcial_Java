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
     
    public boolean esNumeroEntero (String numero){
        int num;
        try{
            num = Integer.parseInt(numero);
            return true;
        }catch(Exception e){
            JOptionPane.showMessageDialog(null, " ERROR. Ingrese solo numeros.");
            return false;
        }
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
    public boolean esReal (String numero){
        boolean sw;
        double num = 0;
        try{
            num = Double.parseDouble(numero);
            sw = true;
        }catch(Exception e){
            JOptionPane.showMessageDialog(null,"ERROR, los creditos deben ser solo numeros.");
            sw = false;
        }
        return sw;
    }
}
