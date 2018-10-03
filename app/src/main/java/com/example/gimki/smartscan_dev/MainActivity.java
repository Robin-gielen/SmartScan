package com.example.gimki.smartscan_dev;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity {

    int count = 1;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        final TextView changingText = findViewById(R.id.change_text_button);
        Button changeTextButton = findViewById(R.id.button);

        changeTextButton.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                switch (count) {
                    case 1: changingText.setText("Is Arno Gay ?"); count++; break;
                    case 2: changingText.setText("I think he is."); count++; break;
                    case 3: changingText.setText("Does Fabian think Arno is gay ?"); count++; break;
                    case 4: changingText.setText("Yes!"); count++; break;
                    case 5: changingText.setText("Does Arno think Fabian is gay ?"); count++; break;
                    case 6: changingText.setText("Yes !"); count++; break;
                    case 7: changingText.setText("Good."); break;
                }

            }
        });

        Button camera = findViewById(R.id.cameraButton);

        camera.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent("android.media.action.IMAGE_CAPTURE");
                startActivity(intent);
            }
        });
    }

    @Override
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
    }
}
