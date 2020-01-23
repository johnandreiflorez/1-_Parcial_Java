/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package coffeecompany;

/**
 *
 * @author COMPUFACIL03
 */
public class Zonas {
    private String zona,pais,ciudad,nivelEdu;
    private double iva;

    public Zonas() {
    }

    public Zonas(String zona, String pais, String ciudad, String nivelEdu, double iva) {
        this.zona = zona;
        this.pais = pais;
        this.ciudad = ciudad;
        this.nivelEdu = nivelEdu;
        this.iva = iva;
    }

    public String getZona() {
        return zona;
    }

    public void setZona(String zona) {
        this.zona = zona;
    }

    public String getPais() {
        return pais;
    }

    public void setPais(String pais) {
        this.pais = pais;
    }

    public String getCiudad() {
        return ciudad;
    }

    public void setCiudad(String ciudad) {
        this.ciudad = ciudad;
    }

    public String getNivelEdu() {
        return nivelEdu;
    }

    public void setNivelEdu(String nivelEdu) {
        this.nivelEdu = nivelEdu;
    }

    public double getIva() {
        return iva;
    }

    public void setIva(double iva) {
        this.iva = iva;
    }
    
}
