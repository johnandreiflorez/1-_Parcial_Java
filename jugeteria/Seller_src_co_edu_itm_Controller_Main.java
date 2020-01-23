package co.edu.itm.Controller;

import co.edu.itm.Dao.FileIn;
import co.edu.itm.Model.Store;

public class Main {

    public static void main(String args[]) {
        FileIn fileIn =new FileIn();
        Store store = new Store(fileIn.readTxt("C:\\Users\\\\Usuario\\Desktop\\store.txt"));
        //System.out.println(store.toString());
        System.out.println(store.toStringCostumers());
        //System.out.println(store.getBiggestUnitPurchase());
        //System.out.println(store.getThreeBiggerUnitPurchase());
    }
}
