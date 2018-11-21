package com.example.gimki.smartscan_dev;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import Model.Client;
import data.remote.RestApiService;
import data.remote.ApiUtils;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;

import static com.example.gimki.smartscan_dev.KeyValueDB.setPassword;
import static com.example.gimki.smartscan_dev.KeyValueDB.setUsername;

//import android.os.StrictMode;
//import android.preference.PreferenceActivity;

public class SignUp extends AppCompatActivity {


    private static final String TAG = "";
    Context mContext;

    //RESTApi linked ressources
    public static final String BASE_URL = "http://www.smartscan-bc.ovh/RESTApi/v1/Api.php";

    private RestApiService mAPIService;

    private static Retrofit retrofit = null;

    //final TextView username = findViewById(R.id.signUp_pseudoFill);

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

        //RESTAPI related
        mAPIService = ApiUtils.getAPIService();


        signUp.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                String tempUsername = username.getText().toString();
                String tempPassword = password.getText().toString();
                String tempPasswordVerif = passwordVerif.getText().toString();

                setUsername(mContext, tempUsername);
                if(tempPassword.equals(tempPasswordVerif)) {
                    sendPost();



                    setPassword(mContext, tempPassword);
                    //launchActivityLogin();
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

    public void sendPost() {
        mAPIService.savePost("testAPPpi","testAPPpi","testAPPpi","testAPPpi","testAPPpi","testAPPpi","testAPPpi").enqueue(new Callback<Client>() {
            @Override
            public void onResponse(Call<Client> call, Response<Client> response) {

                if(response.isSuccessful()) {
                    showResponse(response.body().toString());
                    Log.i(TAG, "post submitted to API." + response.body().toString());
                }
            }

            @Override
            public void onFailure(Call<Client> call, Throwable t) {
                Log.e(TAG, "Unable to submit post to API.");
            }
        });
    }

    public void showResponse(String response) {
        final TextView username = findViewById(R.id.signUp_pseudoFill);
        if(username.getVisibility() == View.GONE) {
            username.setVisibility(View.VISIBLE);
        }
        username.setText(response);
    }
}
