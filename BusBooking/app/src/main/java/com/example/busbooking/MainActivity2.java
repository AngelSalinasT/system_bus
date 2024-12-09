package com.example.busbooking;

import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

import androidx.activity.EdgeToEdge;
import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

import com.android.volley.Request;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.busbooking.interfaces.UserAPI;
import com.example.busbooking.models.User;
import com.google.android.material.button.MaterialButton;

import org.json.JSONException;
import org.json.JSONObject;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class MainActivity2 extends AppCompatActivity {

    TextView Tv_Hello;
    MaterialButton Mb_Search_Trip;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        setContentView(R.layout.activity_main2);

        Tv_Hello = findViewById(R.id.Hello);
        Mb_Search_Trip = findViewById(R.id.Search_trip);

        Mb_Search_Trip.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                findRequest();
            }
        });
    }

    private void findRequest(){

        String url = "http://127.0.0.1:8000/api/v1/users?email[eq]=sebas@gmail.com";

        StringRequest postRequest = new StringRequest(Request.Method.GET, url, new com.android.volley.Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject jsonObject = new JSONObject(response);
                    Tv_Hello.setText(jsonObject.getString("name"));
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }, new com.android.volley.Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.e("error", error.getMessage());
            }
        });
        Volley.newRequestQueue(this).add(postRequest);
    }

    private void find (String email) {
        Retrofit retrofit = new Retrofit.Builder().baseUrl("http://127.0.0.1:8000/")
                .addConverterFactory(GsonConverterFactory.create()).build();

        UserAPI userAPI = retrofit.create(UserAPI.class);
        Call<User> call = userAPI.find(email);
        call.enqueue(new Callback<User>() {
            @Override
            public void onResponse(@NonNull Call<User> call, @NonNull Response<User> response) {
                try {
                    if (response.isSuccessful()){
                        User user = response.body();
                        Tv_Hello.setText(user.getName());
                    }
                }catch (Exception e){
                    Toast.makeText(MainActivity2.this, e.getMessage(), Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(@NonNull Call<User> call, @NonNull Throwable t) {
                Toast.makeText(MainActivity2.this, "Error de conexión", Toast.LENGTH_SHORT).show();
            }
        });
    }
}