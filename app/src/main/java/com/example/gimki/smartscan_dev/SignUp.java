package com.example.gimki.smartscan_dev;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.os.StrictMode;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

//Mongodb
import com.mongodb.MongoClient;
import com.mongodb.MongoClientURI;
import com.mongodb.client.MongoCollection;
import com.mongodb.client.MongoDatabase;


import org.bson.Document;

import static com.example.gimki.smartscan_dev.KeyValueDB.setPassword;
import static com.example.gimki.smartscan_dev.KeyValueDB.setUsername;

public class SignUp extends AppCompatActivity {


    Context mContext;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        //Automatic code
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sign_up);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        //Enf od automatic code

        mContext = this;

        Button signUp = findViewById(R.id.signUp_button);
        final TextView username = findViewById(R.id.signUp_pseudoFill);
        final TextView password = findViewById(R.id.signUp_pswdFill);
        final TextView passwordVerif = findViewById(R.id.signUp_pswdVerifFill);
        signUp.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                String tempUsername = username.getText().toString();
                String tempPassword = password.getText().toString();
                String tempPasswordVerif = passwordVerif.getText().toString();

                setUsername(mContext, tempUsername);
                if(tempPassword.equals(tempPasswordVerif)) {
                    /*MongoClientURI uri  = new MongoClientURI("mongodb://\"mich\":\"mich\"@51.75.127.231:27017/admin");
                    MongoClient client = new MongoClient(uri);
                    MongoDatabase db = client.getDatabase(uri.getDatabase());
                    MongoCollection<Document> coll = db.getCollection("newDB");

                    Document doc = new Document("username", username)
                                    .append("password",password);
                    coll.insertOne(doc);
                    client.close();*/

                    setPassword(mContext, tempPassword);
                    launchActivityLogin();
                }
                else {
                    username.setText("Pswd not identical");
                }
            }
        });
    }

    private void launchActivityLogin() {
        Intent intent = new Intent(mContext, Login.class);
        startActivity(intent);
    }
}
