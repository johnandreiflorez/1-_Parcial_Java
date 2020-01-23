package yourif.youplayltda;


import java.util.logging.Logger;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author salak404
 */
public class ActioToy {
    private String code;
    private String name;
    private int jointNumber;
    private int unitPrice;
    private int limitAge;
    private String clothingType;
    private String enemyName;
    public ActioToy(String code,String name,int jointNumber,int unitPrice,int limitAge,String clothingType,String enemyName){

        this.code=code;
        this.name=name;
        this.jointNumber=jointNumber;
        this.unitPrice=unitPrice;
        this.limitAge=limitAge;
        this.clothingType=clothingType;
        this.enemyName=enemyName;
    }

    public void setCode(String code) {
        this.code = code;
    }

    public void setName(String name) {
        this.name = name;
    }

    public void setJointNumber(int jointNumber) {
        this.jointNumber = jointNumber;
    }

    public void setUnitPrice(int unitPrice) {
        this.unitPrice = unitPrice;
    }

    public void setLimitAge(int limitAge) {
        this.limitAge = limitAge;
    }

    public void setClothingType(String clothingType) {
        this.clothingType = clothingType;
    }

    public void setEnemyName(String enemyName) {
        this.enemyName = enemyName;
    }
    
    public String getCode() {
        return code;
    }

    public String getName() {
        return name;
    }

    public int getJointNumber() {
        return jointNumber;
    }

    public int getUnitPrice() {
        return unitPrice;
    }

    public int getLimitAge() {
        return limitAge;
    }

    public String getClothingType() {
        return clothingType;
    }

    public String getEnemyName() {
        return enemyName;
    }
    
}
