/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package clases;

/**
 *
 * @author Andrei Florez V
 */
public class persona {
    private String nombrePersona;
    private String apellido;
    private compra [] compras;
    private int i=1;

    public persona(String nombrePersona, String apellido) {
        this.nombrePersona = nombrePersona;
        this.apellido = apellido;
        i++;
    }

    public persona() {
    }
   
    public String getNombrePersona() {
        return nombrePersona;
    }

    public void setNombrePersona(String nombrePersona) {
        this.nombrePersona = nombrePersona;
    }

    public String getApellido() {
        return apellido;
    }

    public void setApellido(String apellido) {
        this.apellido = apellido;
    }

    public void pushProductos (compra producto){
        compras= new compra[i];
        for(int j=0 ; j<i;j++ ){
            compras[j]=producto;
        } 
        i++;
    }
    public double precio(){
        double suma=0;
        for(int j=0 ; j<compras.length;j++ ){
            suma+=compras[j].getPrecio()*compras[j].getCantidad();
        } 
        return suma;
    }
    public String descuento (double total){
        if(total>200000)
            return "se aplica el 30% de descuento para unt total a pagar de: "+total*0.70;
        else
            return "se aplica el 5% de descuento para unt total a pagar de: "+total*0.95;
    }
    public String productos(){
        String cadena="";
        for(int j=0 ; j<compras.length;j++ ){
            cadena += compras[j].getCantidad()+"-- "+compras[j].getNombreProducto()+"------------ "+compras[j].getPrecio()+"<br>";
        }
        return cadena;
    }
    
}
