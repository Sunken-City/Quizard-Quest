package com.example.quizardquest;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.util.EntityUtils;
import org.json.JSONArray;
import org.json.JSONException;

import com.example.quizardquest.MainActivity.LoginToGame;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Spinner;

public class DeckSelect extends Activity {
	ArrayList<Deck> totalDecks = new ArrayList<Deck>();
	ArrayList<Card> playerCards = new ArrayList<Card>();
	private ProgressDialog pDialog;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
        setContentView(R.layout.selectdeck);
        Intent intent = getIntent();
        @SuppressWarnings("unchecked")
		ArrayList<Deck> newDecks = (ArrayList<Deck>)intent.getSerializableExtra("playerDecks");
        totalDecks=newDecks;//if it's a string you stored.
//        Log.d("NDM",totalDecks.get(0).getName());
        
//        ArrayList<Card> newCards = new ArrayList<Card>();
//        //Create Test Decks
//        for(int i = 0; i < 5; i++){
//        	Card newCard = new Card("question " + i,"answer " + i ,"category " + i );
//        	newCards.add(newCard);
//        }
//
//        Deck newDeck = new Deck("Deck 1", 1);
//        Deck newDeck2 = new Deck("Deck 2", 2);
//        Deck newDeck3 = new Deck("Deck 3", 3);
//        
//        totalDecks.add(newDeck);
//        totalDecks.add(newDeck2);
//        totalDecks.add(newDeck3);
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
		getDeckCards getCards= new getDeckCards();
	    getCards.execute("http://54.200.66.93/Quizard-Quest/API_Server/androidGetDeckCards.php");
		
		//TextView deckName = (TextView)findViewById(R.id.deckwelcome);
		//deckName.setText(chosenDeck.getName());
//		ArrayList<Card> newCards = new ArrayList<Card>();
//		 for(int i = 0; i < 5; i++){
//        	Card newCard = new Card("question " + i,"answer " + i ,"category " + i );
//	        	newCards.add(newCard);
//	        }
//		Deck chosenDeck= new Deck("chosenDeck",4);

	}
	  
	
class getDeckCards extends AsyncTask<String, Void, JSONArray>{
    	
    	
    	@Override
    	protected void onPreExecute() {
    		super.onPreExecute();
    		pDialog = new ProgressDialog(DeckSelect.this);
    		pDialog.setMessage("Opening Spellbook...");
    		pDialog.setIndeterminate(false);
    		pDialog.setCancelable(false);
    		pDialog.show();
    	}
    	
    	protected JSONArray doInBackground(String... urls) {
    		Spinner deckSpinner = (Spinner)findViewById(R.id.decklist);
    		int deckPosition = deckSpinner.getSelectedItemPosition();
    		int deckID = totalDecks.get(deckPosition).getId();
    		return getCards(urls[0],deckID);
    	}
    	protected void onPostExecute(JSONArray result) {
    		
    		Spinner deckSpinner = (Spinner)findViewById(R.id.decklist);
    		int deckPosition = deckSpinner.getSelectedItemPosition();
    		Deck chosenDeck = totalDecks.get(deckPosition);
    		parseJson(result);
    		chosenDeck.insertCards(playerCards);
    	    Intent beginGame = new Intent(DeckSelect.this, GameMode.class);
    	    beginGame.putExtra("Deck", chosenDeck); //Optional parameters
    	    startActivityForResult(beginGame,1);
    		pDialog.dismiss();
    	}
    }
    
    public void parseJson(JSONArray result){
    	try {

    	for(int i = 0; i < result.length();i++){
    		Card newCard = new Card(result.getJSONObject(i).getString("question"),result.getJSONObject(i).getString("answer"), result.getJSONObject(i).getString("category"));
			playerCards.add(newCard);
			}
		} catch (JSONException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
    	}
    	//Log.d("NDM", playerDecks.get(0).getName());
    }
    public JSONArray getCards(String url,int deckID) {
    	JSONArray cardsJson = new JSONArray();
    	HttpClient client = new DefaultHttpClient();
    	List<NameValuePair> request = new ArrayList<NameValuePair>();
    	request.add(new BasicNameValuePair("deckID",String.valueOf(deckID)));
    	HttpPost post = new HttpPost(url);
    	try {
    		post.setEntity(new UrlEncodedFormEntity(request));
    		HttpResponse response = client.execute(post);
    		HttpEntity entity = response.getEntity();
    		if (null != entity) {
    			String result = EntityUtils.toString(entity);
    			Log.d("NDM",result);

    			cardsJson = getJson(result);
    		}
    	}catch(ClientProtocolException e) {
    		e.printStackTrace();
    	}catch (IOException e) {
    		e.printStackTrace();
    	}catch (JSONException e) {
    		e.printStackTrace();
    	}
    	
    	return cardsJson;
    }


	public JSONArray getJson(String result) throws JSONException{
		// TODO Auto-generated method stub
		JSONArray jsonArr;
		jsonArr = new JSONArray(result);
		return jsonArr;
	}

}
