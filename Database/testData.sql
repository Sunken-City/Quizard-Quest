USE quizardQuest;

#cardID = 1 to 7
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(1, "What is the answer?", "What IS NOT the answer", 1, "Philosophy", 1);
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(1, "Who is the answer?", "Who IS NOT the answer", 1, "Philosophy", 1);
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(1, "Where is the answer?", "Where IS NOT the answer", 1, "Philosophy", 1);
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(1, "When is the answer?", "When IS NOT the answer", 1, "Philosophy", 1);
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(1, "Why is the answer?", "Why IS NOT the answer", 1, "Philosophy", 1);  
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(1, "How is the answer?", "The answer is doing well, thanks for asking", 1, "Philosophy", 1);
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(1, "What is the answer?", "What IS NOT the answer", 1, "Philosophy", 1);


#cardID = 8 to 13
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(1, "How are you?", "Fine, thank you.", 2, "Greetings", 4);
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(1, "How are you?", "Go to Hell.", 2, "Greetings", 4);
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(1, "How are you?", "No, how are YOU?", 2, "Greetings", 4);
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(1, "How are you?", "You wanna fight?", 2, "Greetings", 4);
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(1, "How are you?", "I would like a number 3 with a large Coke.", 2, "Greetings", 4);
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(1, "How are you?", "Could you be ANY ruder?", 2, "Greetings", 4);


#cardID = 14 to 23
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(2, "ABCDE", "ABCDE", 3, "Alphabet", 2);
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(2, "EFG", "EFG", 3, "Alphabet", 2);
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(2, "HIJ", "HIJ", 3, "Alphabet", 2);
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(2, "KL", "KL", 3, "Alphabet", 2);
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(2, "MNO", "MNO", 3, "Alphabet", 2);
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(2, "PQR", "PQR", 3, "Alphabet", 2);
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(2, "STU", "STU", 3, "Alphabet", 2);
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(2, "VW", "VW", 3, "Alphabet", 2);
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(2, "XY", "XY", 3, "Alphabet", 2);
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(2, "Z", "1", 3, "Alphabet", 2);


#cardID = 24 to 28
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(3, "1", "2", 3, "Numbers", 1);
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(3, "3", "4", 3, "Numbers", 2);
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(3, "5", "6", 3, "Numbers", 3);
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(3, "7", "8", 3, "Numbers", 4);
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(3, "9", "0", 3, "Numbers", 5);


#cardID = 29 to 32
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(3, "10", "11", 3, "Binary", 5);
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(3, "100", "101", 3, "Binary", 4);
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(3, "110", "111", 3, "Binary", 3);
INSERT INTO cards (userID, question, answer, category, subCategory, difficulty) VALUES(3, "1000", "1001", 3, "Binary", 2);

INSERT INTO decks(userID, name) VALUES (1, "Greetings!");
INSERT INTO decks(userID, name) VALUES (1, "Questions of Philosophy");

INSERT INTO decks(userID, name) VALUES (2, "The alphabet and you");

INSERT INTO decks(userID, name) VALUES (3, "Adding 1 to numbers");
INSERT INTO decks(userID, name) VALUES (3, "Adding 1 to binary numbers");

INSERT INTO deckCards(deckID, cardID) VALUES (1, 1);
INSERT INTO deckCards(deckID, cardID) VALUES (1, 2);
INSERT INTO deckCards(deckID, cardID) VALUES (1, 3);
INSERT INTO deckCards(deckID, cardID) VALUES (1, 4);
INSERT INTO deckCards(deckID, cardID) VALUES (1, 5);
INSERT INTO deckCards(deckID, cardID) VALUES (1, 6);
INSERT INTO deckCards(deckID, cardID) VALUES (1, 7);

INSERT INTO deckCards(deckID, cardID) VALUES (2, 8);
INSERT INTO deckCards(deckID, cardID) VALUES (2, 9);
INSERT INTO deckCards(deckID, cardID) VALUES (2, 10);
INSERT INTO deckCards(deckID, cardID) VALUES (2, 11);
INSERT INTO deckCards(deckID, cardID) VALUES (2, 12);
INSERT INTO deckCards(deckID, cardID) VALUES (2, 13);

INSERT INTO deckCards(deckID, cardID) VALUES (3, 14);
INSERT INTO deckCards(deckID, cardID) VALUES (3, 15);
INSERT INTO deckCards(deckID, cardID) VALUES (3, 16);
INSERT INTO deckCards(deckID, cardID) VALUES (3, 17);
INSERT INTO deckCards(deckID, cardID) VALUES (3, 18);
INSERT INTO deckCards(deckID, cardID) VALUES (3, 19);
INSERT INTO deckCards(deckID, cardID) VALUES (3, 20);
INSERT INTO deckCards(deckID, cardID) VALUES (3, 21);
INSERT INTO deckCards(deckID, cardID) VALUES (3, 22);
INSERT INTO deckCards(deckID, cardID) VALUES (3, 23);

INSERT INTO deckCards(deckID, cardID) VALUES (4, 24);
INSERT INTO deckCards(deckID, cardID) VALUES (4, 25);
INSERT INTO deckCards(deckID, cardID) VALUES (4, 26);
INSERT INTO deckCards(deckID, cardID) VALUES (4, 27);
INSERT INTO deckCards(deckID, cardID) VALUES (4, 28);

INSERT INTO deckCards(deckID, cardID) VALUES (5, 29);
INSERT INTO deckCards(deckID, cardID) VALUES (5, 30);
INSERT INTO deckCards(deckID, cardID) VALUES (5, 31);
INSERT INTO deckCards(deckID, cardID) VALUES (5, 32);


