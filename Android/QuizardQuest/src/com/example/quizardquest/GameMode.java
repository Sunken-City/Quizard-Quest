package com.example.quizardquest;

import java.util.ArrayList;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import android.widget.TextView;

public class GameMode extends Activity{
	
	ArrayList<Card> cardDeck = new ArrayList<Card>();
	int counter = 0;
	int wrongCount = 0;
	int correctCount = 0;
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
        setContentView(R.layout.quest_page);
        Intent intent = getIntent();
        Deck chosenDeck = (Deck)intent.getSerializableExtra("Deck"); 
        cardDeck = chosenDeck.getCards();
        LinearLayout endPage = (LinearLayout)findViewById(R.id.endScreen);
        endPage.setVisibility(View.INVISIBLE);
        TextView deckName = (TextView)findViewById(R.id.quest_deckname);
        EditText answer = (EditText)findViewById(R.id.answer);
        RelativeLayout questPage = (RelativeLayout)findViewById(R.id.quest_page);
        newQuestion(questPage);
        deckName.setText(chosenDeck.getName());

        
        
//        final Button submitAnswer = (Button) findViewById(R.id.submit_answer);
//        submitAnswer.setEnabled(false);
//        
//        answer.addTextChangedListener(new TextWatcher(){
//            public void afterTextChanged(Editable s) {
//           	 if(Integer.parseInt(answer.getText().toString()) > 0)
//           		 submitAnswer.setEnabled(true);
//           	 else
//           		 submitAnswer.setEnabled(false);
//            }
//            public void beforeTextChanged(CharSequence s, int start, int count, int after){}
//            public void onTextChanged(CharSequence s, int start, int before, int count){}
//            
//        });
	}
	
	public void newQuestion(View View){
        
		EditText answer = (EditText)findViewById(R.id.answer);
		if(!(counter == cardDeck.size())){
		TextView category = (TextView)findViewById(R.id.category);
        TextView question = (TextView)findViewById(R.id.question);
        
        answer.setText("");
        category.setText(cardDeck.get(counter).getCategory());
        question.setText(cardDeck.get(counter).getQuestion());
        counter++;
		}
		else
		{
			
		}
	}
	
	public void submitAnswer(View View){
		EditText answer = (EditText)findViewById(R.id.answer);
		
		if(answer.getText().toString().equals(cardDeck.get(counter-1).getAnswer())){
			// 1. Instantiate an AlertDialog.Builder with its constructor
			AlertDialog.Builder builder = new AlertDialog.Builder(this);

			// 2. Chain together various setter methods to set the dialog characteristics
			builder.setMessage("You Answered Correctly!")
			       .setTitle("Right!");
			builder.setPositiveButton("Next Question", new DialogInterface.OnClickListener() {
		           public void onClick(DialogInterface dialog, int id) {
		               // User clicked OK button
		           }
		       });
			// 3. Get the AlertDialog from create()
			AlertDialog dialog = builder.create();
			dialog.show();
			
			correctCount++;
		}
		else{
			// 1. Instantiate an AlertDialog.Builder with its constructor
			AlertDialog.Builder builder = new AlertDialog.Builder(this);

			// 2. Chain together various setter methods to set the dialog characteristics
			builder.setMessage("The Correct Answer Was " + cardDeck.get(counter-1).getAnswer())
			       .setTitle("Wrong!");

			builder.setPositiveButton("Next Question", new DialogInterface.OnClickListener() {
		           public void onClick(DialogInterface dialog, int id) {
		               // User clicked OK button
		           }
		       });
			// 3. Get the AlertDialog from create()
			AlertDialog dialog = builder.create();
			dialog.show();
			
			wrongCount++;
		}
		if(counter!=cardDeck.size())
			newQuestion(View);
		else{
			LinearLayout endPage = (LinearLayout)findViewById(R.id.endScreen);
			RelativeLayout questPage = (RelativeLayout)findViewById(R.id.quest_page);
			TextView answerHead = (TextView)findViewById(R.id.answer_head);
			TextView wrong = (TextView)findViewById(R.id.wrong);
			TextView correct = (TextView)findViewById(R.id.correct);
			
			if(correctCount > wrongCount)
				answerHead.setText("Congratulations! Your spellwork is impressive!");
			else if(correctCount == wrongCount)
				answerHead.setText("Your spellwork is adequate, but there remains room for improvement!");
			else
				answerHead.setText("Your spellwork is faulty! Try again and improve.");
			
			correct.setText("Correct: " + correctCount);
			wrong.setText("Wrong: " + wrongCount);
			endPage.setVisibility(View.VISIBLE);
			questPage.setVisibility(View.INVISIBLE);
		}
	}
	
	public void returnToDeck(View view)
	{
		finishActivity(1);
		finish();
	}
}
