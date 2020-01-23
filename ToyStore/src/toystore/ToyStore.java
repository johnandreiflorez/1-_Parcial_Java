/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package toystore;

public class ToyStore {

    public static void main(String args[]) {
        FileIn fileIn =new FileIn();
        Store store = new Store(fileIn.readTxt("C:\\Users\\COMPUFACIL03\\Desktop\\LAB_ESTRUCTURA\\ToyStore\\filestore.txt"));
        System.out.println(store.toString());
        System.out.println(store.toStringCostumers());
        //System.out.println(store.getBiggestUnitPurchase());
        //System.out.println(store.getThreeBiggerUnitPurchase());
    }
}