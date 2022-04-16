package com.example.scoregreat;


import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;

import androidx.annotation.Nullable;
import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import com.google.firebase.database.ChildEventListener;
import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;

import java.util.ArrayList;


public class AddAwaFragment extends Fragment {
    ListView lw;
    DatabaseReference md;
    String ques;
    ArrayList<String> list = new ArrayList<>();
    SharedPreferences sp;
    //    private TestViewModel viewModel;
    public View onCreateView(@NonNull final LayoutInflater inflater,
                             ViewGroup container, Bundle savedInstanceState) {
        View root = inflater.inflate(R.layout.activity_add_awa_fragment, container, false);

        lw = root.findViewById(R.id.listview);
        final ArrayAdapter<String> adapter = new ArrayAdapter<>(getContext(),R.layout.mytext,list);
        md = FirebaseDatabase.getInstance().getReference().child("questions").child("awa");

        lw.setAdapter(adapter);
        sp = getActivity().getSharedPreferences("Ques", Context.MODE_PRIVATE);
        final SharedPreferences.Editor editor = sp.edit();

        md.addChildEventListener(new ChildEventListener() {
            @Override
            public void onChildAdded(@NonNull DataSnapshot dataSnapshot, @Nullable String s) {
                list.add(dataSnapshot.getValue((String.class)));
                adapter.notifyDataSetChanged();
            }

            @Override
            public void onChildChanged(@NonNull DataSnapshot dataSnapshot, @Nullable String s) {

            }

            @Override
            public void onChildRemoved(@NonNull DataSnapshot dataSnapshot) {
                list.add(dataSnapshot.getValue((String.class)));
                adapter.notifyDataSetChanged();
            }

            @Override
            public void onChildMoved(@NonNull DataSnapshot dataSnapshot, @Nullable String s) {

            }

            @Override
            public void onCancelled(@NonNull DatabaseError databaseError) {

            }
        });

        lw.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long l) {
                ques = (String) adapterView.getItemAtPosition(i);
                Intent intent = new Intent(getActivity(), WriteAwa.class);
                intent.putExtra("ques",ques);
                startActivity(intent);
                getActivity().finish();
            }
        });

        return root;
    }

}