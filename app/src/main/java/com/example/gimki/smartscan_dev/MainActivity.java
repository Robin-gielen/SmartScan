package com.example.gimki.smartscan_dev;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.Button;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity {

    Context mContext;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        mContext = this;
        // Initialisation of the buttons
        Button logged = findViewById(R.id.mainLoggedButton);
        Button login = findViewById(R.id.mainLoginButton);
        Button manualEntry = findViewById(R.id.mainSignUpButton);
        Button mdpOublie = findViewById(R.id.mainMdpOublieButton);
        Button signUp = findViewById(R.id.mainSignUpButton);

        logged.setOnClickListener(new View.OnClickListener(){

            @Override
            public void onClick(View v) {
                launchActivityLogged();
            }
        });
        login.setOnClickListener(new View.OnClickListener(){

            @Override
            public void onClick(View v) {
                launchActivityLogin();
            }
        });
        manualEntry.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                launchActivityManualEntry();
            }
        });
        mdpOublie.setOnClickListener(new View.OnClickListener(){

            @Override
            public void onClick(View v) {
                launchActivitymdpOublie();
            }
        });
        signUp.setOnClickListener(new View.OnClickListener(){

            @Override
            public void onClick(View v) {
                launchActivitySignUp();
            }
        });
    }




    /*@Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }*/

    private void launchActivityLogged() {
        Intent intent = new Intent(mContext, Logged.class);
        startActivity(intent);
    }
    private void launchActivityLogin() {
        Intent intent = new Intent(mContext, Login.class);
        startActivity(intent);
    }
    private void launchActivityManualEntry() {
        Intent intent = new Intent(mContext, manualEntry.class);
        startActivity(intent);
    }
    private void launchActivitymdpOublie() {
        Intent intent = new Intent(mContext, mdpOublie.class);
        startActivity(intent);
    }
    private void launchActivitySignUp() {
        Intent intent = new Intent(this, SignUp.class);
        startActivity(intent);
    }
}
