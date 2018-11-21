package data.remote;

public class ApiUtils {

    private ApiUtils() {}

    public static final String BASE_URL = "http://www.smartscan-bc.ovh/RESTApi/v1/Api.php/";

    public static RestApiService getAPIService() {

        return RetrofitClient.getClient(BASE_URL).create(RestApiService.class);
    }
}
