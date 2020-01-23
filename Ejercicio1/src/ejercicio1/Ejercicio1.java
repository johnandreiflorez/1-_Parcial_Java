/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package ejercicio1;

import modelo.Viaje;
import control.*;

/**
 *
 * @author Andrei Florez V
 */
public class Ejercicio1 {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        // TODO code application logic here
        boolean sw = true;
        ValidacionGeneral objGeneral = new ValidacionGeneral();
        Viaje objViaje = new Viaje();
        do{
            objViaje.setDistancia(objGeneral.esNumeroEntero("Cual es la distancia a recorre: "));
            objViaje.setEstancia(objGeneral.esNumeroEntero("Cuantos dias se quedara en el pais: "));
        }while(sw);
        Cotizacion objCotizacion = new Cotizacion();
        objCotizacion.generarCosto(objViaje);
        
    }
    
}
