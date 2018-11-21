package com.example.gimki.smartscan_dev;

import android.content.Context;
import android.os.Bundle;
import android.preference.PreferenceActivity;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;


import org.json.JSONObject;

public class manualEntry extends AppCompatActivity {

    Context mContext;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_manual_entry);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        mContext = this;

        Button addContactButton = findViewById(R.id.manualEntryAddButton);

        /*
        final TextView nom = findViewById(R.id.manualEntryNameFill);
        final TextView prenom = findViewById(R.id.manualEntryFNameFill);
        final TextView email = findViewById(R.id.manualEntryMailFill);
        final TextView job = findViewById(R.id.manualEntryJobFill);
        final TextView gsm = findViewById(R.id.manualEntryGSMFill);
        final TextView addresse = findViewById(R.id.manualEntryAddressFill);
        final TextView codePostal = findViewById(R.id.manualEntryPostalCodeFill);
        final TextView entreprise = findViewById(R.id.manualEntryCompanyFill);


        addContactButton.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {

                String tempNom = nom.getText().toString();
                String tempPrenom = prenom.getText().toString();
                String tempEmail = email.getText().toString();
                String tempJob = job.getText().toString();
                String tempGSM = gsm.getText().toString();
                String tempAddresse = addresse.getText().toString();
                String tempCodePostal = codePostal.getText().toString();
                String tempEntreprise = entreprise.getText().toString();




            }
        });*/
    }

}
