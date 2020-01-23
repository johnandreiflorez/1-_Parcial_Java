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
public class Factura {
    int numero;
    String fecha;
    double total;
    String codClie;

    public Factura(int numero, String fecha, double total, String codClie) {
        this.numero = numero;
        this.fecha = fecha;
        this.total = total;
        this.codClie = codClie;
    }

    public Factura() {
        this.numero = 0;
        this.fecha = "";
        this.total = 0;
        this.codClie = "";        
    }

    public int getNumero() {
        return numero;
    }

    public void setNumero(int numero) {
        this.numero = numero;
    }

    public String getFecha() {
        return fecha;
    }

    public void setFecha(String fecha) {
        this.fecha = fecha;
    }

    public double getTotal() {
        return total;
    }

    public void setTotal(double total) {
        this.total = total;
    }

    public String getCodClie() {
        return codClie;
    }

    public void setCodClie(String codClie) {
        this.codClie = codClie;
    }
    
}
