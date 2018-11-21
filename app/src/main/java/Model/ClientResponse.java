package Model;

import java.util.List;

import Model.Client;

public class ClientResponse {

    private int page;
    private List<Client> results;
    private int totalResults;
    private int totalPages;

    public ClientResponse(int page, List<Client> results, int totalResults, int totalPages) {
        this.page = page;
        this.results = results;
        this.totalResults = totalResults;
        this.totalPages = totalPages;
    }

    public int getPage() {
        return page;
    }

    public void setPage(int page) {
        this.page = page;
    }

    public List<Client> getResults() {
        return results;
    }

    public void setResults(List<Client> results) {
        this.results = results;
    }

    public int getTotalResults() {
        return totalResults;
    }

    public void setTotalResults(int totalResults) {
        this.totalResults = totalResults;
    }

    public int getTotalPages() {
        return totalPages;
    }

    public void setTotalPages(int totalPages) {
        this.totalPages = totalPages;
    }
}
