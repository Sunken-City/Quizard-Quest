package com.example.quizardquest;


public class Card {
	
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
}
