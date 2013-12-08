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

import android.app.Activity;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Typeface;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

public class MainActivity extends Activity{

	ArrayList<Deck> playerDecks = new ArrayList<Deck>();
	private ProgressDialog pDialog;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

//        TextView txt = (TextView) findViewById(R.id.welcome_text);
//        Typeface font = Typeface.createFromAsset(getAssets(), "PAPYRUS.ttf");
//        txt.setTypeface(font);

//       TextView tv=(TextView)findViewById(R.id.welcome);
//       Typeface font=Typeface.createFromAsset(getAssets(), "NEVERWINTER.ttf");
//
//       tv.setTypeface(font);
        
        Typeface neverwinter = Typeface.createFromAsset(getAssets(), "fonts/NEVERWINTER.TTF");
        Typeface myst = Typeface.createFromAsset(getAssets(), "fonts/DS_Mysticora.ttf");
        TextView tv = (TextView) findViewById(R.id.welcome_text);
        tv.setTypeface(neverwinter);
        TextView tv2 = (TextView) findViewById(R.id.login_text);
        tv2.setTypeface(myst);
        EditText et = (EditText) findViewById(R.id.enter_username);
        et.setTypeface(myst);
        EditText et2 = (EditText) findViewById(R.id.enter_password);
        et2.setTypeface(myst);
        Button button1 = (Button) findViewById(R.id.login_button);
        button1.setTypeface(neverwinter);
        
		View.OnClickListener buttonClickListener = new View.OnClickListener() {
			
			@Override
			public void onClick(View v) {
				//Add logic for button
				login(v);
				
			}
		};
		
		button1.setOnClickListener(buttonClickListener);
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.main, menu);
        return true;
    }
    
    public void login(View view){
    	
    LoginToGame decksLogin= new LoginToGame();
    decksLogin.execute("http://54.200.66.93/Quizard-Quest/API_Server/androidLogin.php");
    //Log.d("NDM", playerDecks.get(0).getName());
    //TextView tv = (TextView) findViewById(R.id.welcome_text);
    //tv.setText(decks.get(0).getName());
    
    }
    
    class LoginToGame extends AsyncTask<String, Void, JSONArray>{
    	
    	
    	@Override
    	protected void onPreExecute() {
    		super.onPreExecute();
    		pDialog = new ProgressDialog(MainActivity.this);
    		pDialog.setMessage("Logging in...");
    		pDialog.setIndeterminate(false);
    		pDialog.setCancelable(false);
    		pDialog.show();
    	}
    	
    	protected JSONArray doInBackground(String... urls) {
    		EditText un = (EditText)findViewById(R.id.enter_username);
    		EditText pw = (EditText)findViewById(R.id.enter_password);
    		String username = un.getText().toString();
    		String password = pw.getText().toString();
    		Log.d("NDM",username);
    		Log.d("NDM",password);
    		Log.d("NDM", urls[0]);
    		return getDecks(urls[0],username,password);
    	}
    	protected void onPostExecute(JSONArray result) {

    		Log.d("NDM",result.toString());
    		if(result.length() == 0){
    			pDialog.dismiss();
    			// 1. Instantiate an AlertDialog.Builder with its constructor
				AlertDialog.Builder builder = new AlertDialog.Builder(MainActivity.this);
    			// 2. Chain together various setter methods to set the dialog characteristics
    			builder.setMessage("Incorrect Login. Try Again. Forgot Password? Visit Our Online Site!");

    			builder.setPositiveButton("Okay", new DialogInterface.OnClickListener() {
    		           public void onClick(DialogInterface dialog, int id) {
    		               // User clicked OK button
    		           }
    		       });
    			// 3. Get the AlertDialog from create()
    			AlertDialog dialog = builder.create();
    			dialog.show();
    			Log.d("NDM","okay");
    		}
    		else{
    		parseJson(result);
    	    Intent myIntent = new Intent(MainActivity.this, DeckSelect.class);
    	    myIntent.putExtra("playerDecks",playerDecks); //Optional parameters
    	    MainActivity.this.startActivity(myIntent);
    	    pDialog.dismiss();
    		}
    	}
    }
    
    public void parseJson(JSONArray result){
    	try {

    	for(int i = 0; i < result.length();i++){
				Deck newDeck = new Deck(result.getJSONObject(i).getString("name"),result.getJSONObject(i).getInt("deckID"));
				playerDecks.add(newDeck);
			}
		} catch (JSONException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
    	}
    	Log.d("NDM", playerDecks.get(0).getName());
    }
    public JSONArray getDecks(String url,String username, String password) {
    	JSONArray decksJson = new JSONArray();
    	HttpClient client = new DefaultHttpClient();
    	List<NameValuePair> request = new ArrayList<NameValuePair>();
    	request.add(new BasicNameValuePair("username",username));
    	request.add(new BasicNameValuePair("password",password));
    	HttpPost post = new HttpPost(url);
    	try {
    		post.setEntity(new UrlEncodedFormEntity(request));
    		HttpResponse response = client.execute(post);
    		HttpEntity entity = response.getEntity();
    		if (null != entity) {
    			String result = EntityUtils.toString(entity);
    			Log.d("NDM",result);
    			if(result.equals("239")){
    				return null;
    				}
    			decksJson = getJson(result);
    		}
    	}catch(ClientProtocolException e) {
    		e.printStackTrace();
    	}catch (IOException e) {
    		e.printStackTrace();
    	}catch (JSONException e) {
    		e.printStackTrace();
    	}
    	
    	return decksJson;
    }


	public JSONArray getJson(String result) throws JSONException{
		// TODO Auto-generated method stub
		JSONArray jsonArr;
		jsonArr = new JSONArray(result);
		return jsonArr;
	}
	
//	public void parseJson (JSONObject object) {
//		JSONArray jsonDecks;
//		JSONObject deckString;
//	}
}
