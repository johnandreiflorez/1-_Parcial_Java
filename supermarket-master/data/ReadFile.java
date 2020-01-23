package data;

import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;

import controllers.Main;

public class ReadFile {

    private Main main;

    public ReadFile(Main main) {
        this.main = main;
    }

    public void muestraContenido(String archivo) throws FileNotFoundException, IOException {
        String cadena;
        FileReader f = new FileReader(archivo);
        BufferedReader b = new BufferedReader(f);
        while((cadena = b.readLine())!=null) {
            System.out.println(cadena);
            main.superMarket.makeSell(cadena);
        }
        b.close();
    }
}