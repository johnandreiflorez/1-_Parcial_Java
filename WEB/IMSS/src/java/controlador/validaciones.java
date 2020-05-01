/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controlador;
import Modelo.persona;
/**
 *
 * @author Andrei Florez V
 */
public class validaciones {
    private persona objPersona;
    private String error;

    public validaciones(persona objPersona) {
        this.objPersona = objPersona;
    }
    
    public boolean validarEdad() {
        if(objPersona.getEdad() > 0) {
            return true;
        } else {
            this.setError("La edad debe ser mayor a cero (0).");
            return false;
        }
    }
    public boolean validarNombre(){
        if(objPersona.getNombre().equals("")){
            this.setError("Debes llenar el campo (NOMBRE)");
            return false;
        }else
            return true;
        
    }
    public String clasificarJubilacion (){
        String texto;
        if(objPersona.getEdad()>59&&objPersona.getAntiguedad()<25){
            texto = "jubilación por edad";
        }else{
            if(objPersona.getEdad()<60&&objPersona.getAntiguedad()>24){
                texto = "jubilación por antigüedad joven";
            }else{
                if(objPersona.getEdad()>59&&objPersona.getAntiguedad()>24){
                    texto = "jubilación por antigüedad adulta";
                }else{
                    texto="ERROR AL VALIDAR";
                }
            }
        }    
        return texto;
    }
    public String getError() {
        return error;
    }

    public void setError(String error) {
        this.error = error;
    }
    
}
