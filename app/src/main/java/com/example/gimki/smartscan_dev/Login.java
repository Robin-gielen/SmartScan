package com.example.gimki.smartscan_dev;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import static com.example.gimki.smartscan_dev.KeyValueDB.getPassword;
import static com.example.gimki.smartscan_dev.KeyValueDB.getUsername;

public class Login extends AppCompatActivity {

    Context mContext;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        //Automatic code
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        //Enf od automatic code

        mContext = this;

        Button login = findViewById(R.id.login_button);

        login.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                String tempUsername = getUsername(mContext);
                String tempPassword = getPassword(mContext);

                final TextView username = findViewById(R.id.login_pseudoFill);
                final TextView password = findViewById(R.id.login_pswdFill);

                String usernameTest = username.getText().toString();
                String passwordTest = password.getText().toString();


                if(usernameTest.equals(tempUsername) && passwordTest.equals(tempPassword)) {
                    launchActivityLogged();
                }
                else {
                    username.setText("Wrong credentials");
                }
            }
            private void launchActivityLogged() {
                Intent intent = new Intent(mContext, Logged.class);
                startActivity(intent);
            }
    });
    }
}
