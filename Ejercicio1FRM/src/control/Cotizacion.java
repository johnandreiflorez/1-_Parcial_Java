/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package control;
import javax.swing.JOptionPane;
import modelo.Viaje;
/**
 *
 * @author Andrei Florez V
 */
public class Cotizacion {

    public Cotizacion() {
    }
    public void generarCosto (Viaje objViaje){
        if(objViaje.getDistancia()>1000 && objViaje.getEstancia()>7){
            JOptionPane.showMessageDialog(null, "EL PRECIO DE SU VIAJE ES: "+((objViaje.getDistancia()*3500)*0.7)+ " CON UN AHORRO DEL 30%");
        }else
            JOptionPane.showMessageDialog(null, "EL PRECIO DE SU VIAJE ES: "+(objViaje.getDistancia()*3500));
       
    }
}
