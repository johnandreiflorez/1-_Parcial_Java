/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package yourif.youplayltda;

/**
 *
 * @author salak404
 */
public class ToyStore {
   private ActioToy[] actionToys;
   
   public ToyStore (ActioToy[] actionToys){
       this.actionToys=actionToys;
   }
   public double calculateAveragePriceActionToys(){
       double average=0,acum=0;
       for(int i=0 ;i <actionToys.length;i++)
           acum = acum+ actionToys[i].getUnitPrice();
       average=acum/actionToys.length;
       return average;
   }
}
