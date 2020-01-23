package controllers;

import controllers.SuperMarket;
import data.ReadFile;
import java.io.FileNotFoundException;
import java.io.IOException;

public class Main {

    public static SuperMarket superMarket;
    public static ReadFile readFile;

    public Main()  throws FileNotFoundException, IOException  {
        superMarket = new SuperMarket();
        ReadFile readFile = new ReadFile(this);        
        readFile.muestraContenido("C:/Users/Usuario/Documents/ITM/Laboratorio estructuras/supermarket/sales.txt");
    }

    public static void main(String args[])  throws FileNotFoundException, IOException {
        System.out.println("hello world");
        Main main = new Main();

    }
}