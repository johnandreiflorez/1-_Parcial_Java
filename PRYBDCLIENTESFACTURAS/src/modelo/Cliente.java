/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package modelo;

/**
 *
 * @author docenteitm
 */
public class Cliente {
    String codigo,nombre;
    double credito;

    public Cliente(String codigo, String nombre, double credito) {
        this.codigo = codigo;
        this.nombre = nombre;
        this.credito = credito;
    }

    public Cliente() {
        this.codigo = "";
        this.nombre = "";
        this.credito = 0;        
    }

    public String getCodigo() {
        return codigo;
    }

    public void setCodigo(String codigo) {
        this.codigo = codigo;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public double getCredito() {
        return credito;
    }

    public void setCredito(double credito) {
        this.credito = credito;
    }
    
    
}
