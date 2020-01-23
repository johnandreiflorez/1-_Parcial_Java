/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package readfile;

import coffeecompany.Zonas;

/**
 *
 * @author COMPUFACIL03
 */
public class Container {
    private Cafe objCafe;
    private Zonas objZonas;

    public Container(Cafe objCafe, Zonas objZonas) {
        this.objCafe = objCafe;
        this.objZonas = objZonas;
    }

    public Cafe getObjCafe() {
        return objCafe;
    }

    public void setObjCafe(Cafe objCafe) {
        this.objCafe = objCafe;
    }

    public Zonas getObjZonas() {
        return objZonas;
    }

    public void setObjZonas(Zonas objZonas) {
        this.objZonas = objZonas;
    }
    

    
    
}
