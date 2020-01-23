/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package readfile;

/**
 *
 * @author COMPUFACIL03
 */
public class Cafe {
    private String tipoCafe;
    private double cost;

    public Cafe() {
    }

    public Cafe(String tipoCafe, double cost) {
        this.tipoCafe = tipoCafe;
        this.cost = cost;
    }

    public String getTipoCafe() {
        return tipoCafe;
    }

    public void setTipoCafe(String tipoCafe) {
        this.tipoCafe = tipoCafe;
    }

    public double getCost() {
        return cost;
    }

    public void setCost(double cost) {
        this.cost = cost;
    }
    
}
