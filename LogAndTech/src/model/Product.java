/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package model;

/**
 *
 * @author COMPUFACIL03
 */
public class Product {
    
    private String weightByUnity;
    private String price;
    private String name;
    private String maxWeight;
    
    public Product(){
    }

    public String getWeightByUnity() {
        return weightByUnity;
    }

    public void setWeightByUnity(String weightByUnity) {
        this.weightByUnity = weightByUnity;
    }

    public String getPrice() {
        return price;
    }

    public void setPrice(String price) {
        this.price = price;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getMaxWeight() {
        return maxWeight;
    }

    public void setMaxWeight(String maxWeight) {
        this.maxWeight = maxWeight;
    }
    
}
