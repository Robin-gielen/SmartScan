package com.example.gimki.smartscan_dev;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

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
                    setPassword(mContext, tempPassword);
                    launchActivity();
                }
                else {
                    username.setText("Pswd not identical");
                }
            }
        });
    }

    private void launchActivity() {
        Intent intent = new Intent(mContext, Login.class);
        startActivity(intent);
    }
}
