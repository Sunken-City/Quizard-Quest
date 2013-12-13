package com.example.quizardquest;

import java.io.Serializable;


public class Card implements Serializable {
	
	private String question;
	private String answer;
	private String category;
	
	public Card(String newQuestion, String newAnswer, String newCategory){
		
		question = newQuestion;
		answer = newAnswer;
		category = newCategory;
	}
	

	public String getQuestion()
	{
		return question;
	}
	
	public String getAnswer()
	{
		return answer;
	}
	
	public String getCategory(){
		return category;
	}
}
