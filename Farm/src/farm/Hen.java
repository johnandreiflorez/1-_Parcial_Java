/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package farm;

/**
 *
 * @author salak404
 */
public class Hen {
    private double wight;
    private double height;
    private int eggsPerWeek;
    
    public double calculateQuality()
    {
        double result =
                (this.height * this.wight)
                /
                this.eggsPerWeek;
        return result;
        //return (this.height * this.wight)/ this.eggsPerWeek;
    }
    public double calculateSellPrice()
    {
     double sellPrice = 
             this.calculateQuality() * 18.4+2.1;
        return sellPrice;
    }
}
