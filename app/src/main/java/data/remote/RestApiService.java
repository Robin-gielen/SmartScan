package data.remote;
import Model.Client;
import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.POST;

public interface RestApiService {

    @POST("/posts")
    @FormUrlEncoded
    Call<Client> savePost(@Field("nom") String nom,
                          @Field("prenom") String prenom,
                          @Field("adresse") String adresse,
                          @Field("mail") String mail,
                          @Field("localite") String localite,
                          @Field("pseudo") String pseudo,
                          @Field("password") String password );
}