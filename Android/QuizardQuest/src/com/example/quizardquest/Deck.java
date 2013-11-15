package com.example.quizardquest;

import java.util.ArrayList;

public class Deck {
	private ArrayList<Card> cards;
	private String name;
	
	public Deck(String newName, ArrayList<Card> newCards){
		name = newName;
		cards = new ArrayList<Card>(newCards);
	}
	
	public ArrayList<Card> getCards(){
		return cards;
	}
	
	public String getName(){
		return name;
	}

}
