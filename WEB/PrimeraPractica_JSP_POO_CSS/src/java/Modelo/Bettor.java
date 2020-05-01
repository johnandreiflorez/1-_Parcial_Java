/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Modelo;

import java.util.List;

/**
 *
 * @author Andrei Florez V
 */
public class Bettor {
    private String name;
    private double amount =1000;
    private List<Bet> bets;
    private String status;

    public Bettor(String name) {
        this.name = name;
    }

    public String getName() {
        return name;
    }

    public void lostBet(int round){
        Bet auxBet = this.bets.get(round);
        auxBet.setStatus("LOST");
        this.amount -= auxBet.getAmount();
    }

    public void winBet(int round, double amountOfBet){
        this.bets.get(round).setStatus("WON");
        this.amount += amountOfBet;
    }

    public Bet getBetAt(int pos) {
        return bets.get(pos);
    }
    
    public int sizeBets (){
        return bets.size();
    }

    public void addBet(Bet bet) {
        this.bets.add(bet);
    }

    public String getStatus() {
        return status;
    }
}
