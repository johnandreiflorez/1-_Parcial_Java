/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package modelo;

/**
 *
 * @author Andrei Florez V
 */
public class Viaje {
    private int distancia;
    private int estancia;

    public Viaje() {
    }

    public Viaje(int distancia, int estancia) {
        this.distancia = distancia;
        this.estancia = estancia;
    }

    public int getDistancia() {
        return distancia;
    }

    public void setDistancia(int distancia) {
        this.distancia = distancia;
    }

    public int getEstancia() {
        return estancia;
    }

    public void setEstancia(int estancia) {
        this.estancia = estancia;
    }

    
    
}
