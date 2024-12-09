package com.example.busbooking.interfaces;

import com.example.busbooking.models.User;

import retrofit2.Call;
import retrofit2.http.GET;
import retrofit2.http.Path;

public interface UserAPI {
    @GET("api/v1/users?email[eq]={email}")
    public Call<User> find(@Path("email") String email);
}
