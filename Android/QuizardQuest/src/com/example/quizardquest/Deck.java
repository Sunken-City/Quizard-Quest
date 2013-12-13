package com.example.quizardquest;

import java.io.Serializable;
import java.util.ArrayList;

@SuppressWarnings("serial")
public class Deck implements Serializable {
	private ArrayList<Card> cards;
	private String name;
	private int deckId;
	
	public Deck(String newName, int newDeckId){
		name = newName;
		deckId = newDeckId;
	}
	
	public ArrayList<Card> getCards(){
		return cards;
	}
	
	public String getName(){
		return name;
	}
	
	public void insertCards(ArrayList<Card> newCards){
		cards = new ArrayList<Card>(newCards);
	}

	public int getId(){
		return deckId;
	}
}
