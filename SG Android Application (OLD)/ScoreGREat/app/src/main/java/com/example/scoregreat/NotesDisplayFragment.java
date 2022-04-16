package com.example.scoregreat;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import android.widget.Toast;

import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;
import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;

public class NotesDisplayFragment extends Fragment {
    TextView a;
    FirebaseUser user;
    FirebaseAuth mauth;
    DatabaseReference dr;
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {

        View rv = inflater.inflate(R.layout.activity_notes_display_fragment, container, false);


        try{
            a = rv.findViewById(R.id.noteinfo);
            mauth = FirebaseAuth.getInstance();
            dr = FirebaseDatabase.getInstance().getReference();
            user = mauth.getCurrentUser();

            dr.child("users").child(user.getUid()).child("title_content").addListenerForSingleValueEvent(new ValueEventListener() {
                @Override
                public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                    a.setText(dataSnapshot.getValue().toString());
                }

                @Override
                public void onCancelled(@NonNull DatabaseError databaseError) {

                }
            });
        }
        catch (NullPointerException n){
            Toast.makeText(getActivity(), n.toString(), Toast.LENGTH_SHORT).show();
        }

        return rv;
    }

}
