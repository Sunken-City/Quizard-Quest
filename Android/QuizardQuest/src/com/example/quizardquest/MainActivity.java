package com.example.quizardquest;

import android.app.Activity;
import android.content.Intent;
import android.graphics.Typeface;
import android.os.Bundle;
import android.view.Menu;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

public class MainActivity extends Activity {

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
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.main, menu);
        return true;
    }
    
    public void login(View view){
    Intent myIntent = new Intent(MainActivity.this, DeckSelect.class);
    //myIntent.putExtra("key", value); //Optional parameters
    MainActivity.this.startActivity(myIntent);
    }
}
