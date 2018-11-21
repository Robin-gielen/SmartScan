package Model;

import retrofit2.Call;
import retrofit2.http.POST;
import retrofit2.http.Query;

public interface RestApiService {

    @POST("createuser")
    Call<ClientResponse> createNewClient(@Query("api_key") String apiKey);
}
