package com.example.quizardquest;

import java.util.ArrayList;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Spinner;

public class DeckSelect extends Activity {
	ArrayList<Deck> totalDecks = new ArrayList<Deck>();
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
        setContentView(R.layout.selectdeck);
        //Intent intent = getIntent();
        //String value = intent.getStringExtra("key"); //if it's a string you stored.
        
        ArrayList<Card> newCards = new ArrayList<Card>();
        //Create Test Decks
        for(int i = 0; i < 5; i++){
        	Card newCard = new Card("question " + i,"answer " + i ,"category " + i );
        	newCards.add(newCard);
        }

        Deck newDeck = new Deck("Deck 1", 1);
        Deck newDeck2 = new Deck("Deck 2", 2);
        Deck newDeck3 = new Deck("Deck 3", 3);
        
        totalDecks.add(newDeck);
        totalDecks.add(newDeck2);
        totalDecks.add(newDeck3);
        ArrayList<String> deckNames = new ArrayList<String>();
        for(int i = 0; i < totalDecks.size(); i++){
        	deckNames.add(i +": " + totalDecks.get(i).getName());
        	
        }
//        TableLayout deckTable = (TableLayout) findViewById(R.id.deck_table);
//        TableRow tr = new TableRow(this);
//        LayoutParams lp = new LayoutParams(LayoutParams.MATCH_PARENT, LayoutParams.WRAP_CONTENT);
        //Load Decks
//        for(int i = 0; i < totalDecks.size(); i++){
//        	Button deck = new Button(this);
//        	String deckName = totalDecks.get(i).getName();
//        	deck.setText(deckName);
//        	deck.setLayoutParams(lp);
//        	tr.addView(deck);
//        	deckTable.addView(tr, new TableLayout.LayoutParams(LayoutParams.MATCH_PARENT, LayoutParams.WRAP_CONTENT));
//        }
        
        Spinner deckSpinner = (Spinner)findViewById(R.id.decklist);
        ArrayAdapter<String> deckAdapter = new ArrayAdapter<String>(this, R.layout.spinner_item, deckNames);
        deckSpinner.setAdapter(deckAdapter);
	}
	
	public void beginQuest(View View){
		
		Spinner deckSpinner = (Spinner)findViewById(R.id.decklist);
		int deckPosition = deckSpinner.getSelectedItemPosition();
		Deck chosenDeck = totalDecks.get(deckPosition);
		//TextView deckName = (TextView)findViewById(R.id.deckwelcome);
		//deckName.setText(chosenDeck.getName());
		ArrayList<Card> newCards = new ArrayList<Card>();
		 for(int i = 0; i < 5; i++){
        	Card newCard = new Card("question " + i,"answer " + i ,"category " + i );
	        	newCards.add(newCard);
	        }
//		Deck chosenDeck= new Deck("chosenDeck",4);
		chosenDeck.insertCards(newCards);
	    Intent beginGame = new Intent(this, GameMode.class);
	    beginGame.putExtra("Deck", chosenDeck); //Optional parameters
	    startActivity(beginGame);
	}
	  
	
	public void retrieveDeckQuestions(int deckId){
		
		
	}

}
